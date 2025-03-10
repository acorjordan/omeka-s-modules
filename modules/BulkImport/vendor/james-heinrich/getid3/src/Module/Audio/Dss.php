<?php

namespace JamesHeinrich\GetID3\Module\Audio;

use JamesHeinrich\GetID3\Module\Handler;
use JamesHeinrich\GetID3\Utils;

/////////////////////////////////////////////////////////////////
/// getID3() by James Heinrich <info@getid3.org>               //
//  available at https://github.com/JamesHeinrich/getID3       //
//            or https://www.getid3.org                        //
//            or http://getid3.sourceforge.net                 //
//  see readme.txt for more details                            //
/////////////////////////////////////////////////////////////////
//                                                             //
// module.audio.dss.php                                        //
// module for analyzing Digital Speech Standard (DSS) files    //
//                                                            ///
/////////////////////////////////////////////////////////////////

class Dss extends Handler
{
	/**
	 * @return bool
	 */
	public function Analyze() {
		$info = &$this->getid3->info;

		$this->fseek($info['avdataoffset']);
		$DSSheader  = $this->fread(1540);

		if (!preg_match('#^[\\x02-\\x08]ds[s2]#', $DSSheader)) {
			$this->error('Expecting "[02-08] 64 73 [73|32]" at offset '.$info['avdataoffset'].', found "'.Utils::PrintHexBytes(substr($DSSheader, 0, 4)).'"');
			return false;
		}

		// some structure information taken from http://cpansearch.perl.org/src/RGIBSON/Audio-DSS-0.02/lib/Audio/DSS.pm
		$info['encoding']              = 'ISO-8859-1'; // not certain, but assumed
		$info['dss'] = array();

		$info['fileformat']            = 'dss';
		$info['mime_type']             = 'audio/x-'.substr($DSSheader, 1, 3); // "audio/x-dss" or "audio/x-ds2"
		$info['audio']['dataformat']   =            substr($DSSheader, 1, 3); //         "dss" or         "ds2"
		$info['audio']['bitrate_mode'] = 'cbr';

		$info['dss']['version']            =                            ord(substr($DSSheader,    0,   1));
		$info['dss']['hardware']           =                           trim(substr($DSSheader,   12,  16)); // identification string for hardware used to create the file, e.g. "DPM 9600", "DS2400"
		$info['dss']['unknown1']           =   Utils::LittleEndian2Int(substr($DSSheader,   28,   4));
		// 32-37 = "FE FF FE FF F7 FF" in all the sample files I've seen
		$info['dss']['date_create_unix']   = $this->DSSdateStringToUnixDate(substr($DSSheader,   38,  12));
		$info['dss']['date_complete_unix'] = $this->DSSdateStringToUnixDate(substr($DSSheader,   50,  12));
		$info['dss']['playtime_sec']       = ((int) substr($DSSheader, 62, 2) * 3600) + ((int) substr($DSSheader, 64, 2) * 60) + (int) substr($DSSheader, 66, 2); // approximate file playtime in HHMMSS
		if ($info['dss']['version'] <= 3) {
			$info['dss']['playtime_ms']        =   Utils::LittleEndian2Int(substr($DSSheader,  512,   4)); // exact file playtime in milliseconds. Has also been observed at offset 530 in one sample file, with something else (unknown) at offset 512
			$info['dss']['priority']           =                            ord(substr($DSSheader,  793,   1));
			$info['dss']['comments']           =                           trim(substr($DSSheader,  798, 100));
			$info['dss']['sample_rate_index']  =                            ord(substr($DSSheader, 1538,   1));  // this isn't certain, this may or may not be where the sample rate info is stored, but it seems consistent on my small selection of sample files
			$info['audio']['sample_rate']      = $this->DSSsampleRateLookup($info['dss']['sample_rate_index']);
		} else {
			$this->getid3->warning('DSS above version 3 not fully supported in this version of getID3. Any additional documentation or format specifications would be welcome. This file is version '.$info['dss']['version']);
		}

		$info['audio']['bits_per_sample']  = 16; // maybe, maybe not -- most compressed audio formats don't have a fixed bits-per-sample value, but this is a reasonable approximation
		$info['audio']['channels']         = 1;

		if (!empty($info['dss']['playtime_ms']) && (floor($info['dss']['playtime_ms'] / 1000) == $info['dss']['playtime_sec'])) { // *should* just be playtime_ms / 1000 but at least one sample file has playtime_ms at offset 530 instead of offset 512, so safety check
			$info['playtime_seconds'] = $info['dss']['playtime_ms'] / 1000;
		} else {
			$info['playtime_seconds'] = $info['dss']['playtime_sec'];
			if (!empty($info['dss']['playtime_ms'])) {
				$this->getid3->warning('playtime_ms ('.number_format($info['dss']['playtime_ms'] / 1000, 3).') does not match playtime_sec ('.number_format($info['dss']['playtime_sec']).') - using playtime_sec value');
			}
		}
		$info['audio']['bitrate'] = ($info['filesize'] * 8) / $info['playtime_seconds'];

		return true;
	}

	/**
	 * @param string $datestring
	 *
	 * @return int|false
	 */
	public function DSSdateStringToUnixDate($datestring) {
		$y = (int) substr($datestring,  0, 2);
		$m = (int) substr($datestring,  2, 2);
		$d = (int) substr($datestring,  4, 2);
		$h = (int) substr($datestring,  6, 2);
		$i = (int) substr($datestring,  8, 2);
		$s = (int) substr($datestring, 10, 2);
		$y += (($y < 95) ? 2000 : 1900);
		return mktime($h, $i, $s, $m, $d, $y);
	}

	/**
	 * @param int $sample_rate_index
	 *
	 * @return int|false
	 */
	public function DSSsampleRateLookup($sample_rate_index) {
		static $dssSampleRateLookup = array(
			0x0A => 16000,
			0x0C => 11025,
			0x0D => 12000,
			0x15 =>  8000,
		);
		if (!array_key_exists($sample_rate_index, $dssSampleRateLookup)) {
			$this->getid3->warning('unknown sample_rate_index: 0x'.strtoupper(dechex($sample_rate_index)));
			return false;
		}
		return $dssSampleRateLookup[$sample_rate_index];
	}

}
