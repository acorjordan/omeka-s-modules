/*
 * Copyright 2022 Ivy Rose, Archivo de Respuestas Emergencias de Puerto Rico
 *
 * Licensed under GNU General Public License, Version 3.0
 *
 * This code uses and is derived from pdf.js (https://mozilla.github.io/pdf.js),
 * a project developed by the the Mozilla Foundation. It was modified to
 * be compatible with Omeka S and utilize a custom user interface.
 */
 
 /*
 * Copyright 2014 Mozilla Foundation
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *         http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

"use strict";

// The workerSrc property shall be specified.
//
pdfjsLib.GlobalWorkerOptions.workerSrc = BASE_PATH + "build/pdf.worker.js";

// Some PDFs need external cmaps.
//
const CMAP_URL = "cmaps/";
const CMAP_PACKED = true;

const ENABLE_XFA = true;

const SANDBOX_BUNDLE_SRC = "build/pdf.sandbox.js";

const container = document.getElementById("pdfjs-container");

const eventBus = new pdfjsViewer.EventBus();

// (Optionally) enable hyperlinks within PDF files.
const pdfLinkService = new pdfjsViewer.PDFLinkService({
    eventBus,
});

// (Optionally) enable find controller.
const pdfFindController = new pdfjsViewer.PDFFindController({
    eventBus,
    linkService: pdfLinkService,
});

// (Optionally) enable scripting support.
const pdfScriptingManager = new pdfjsViewer.PDFScriptingManager({
    eventBus,
    sandboxBundleSrc: SANDBOX_BUNDLE_SRC,
});

const pdfViewer = new pdfjsViewer.PDFViewer({
    container,
    eventBus,
    linkService: pdfLinkService,
    findController: pdfFindController,
    scriptingManager: pdfScriptingManager,
    enableScripting: true, // Only necessary in PDF.js version 2.10.377 and below.
});
pdfLinkService.setViewer(pdfViewer);
pdfScriptingManager.setViewer(pdfViewer);

eventBus.on("pagesinit", function () {
    // We can use pdfViewer now, e.g. let's change default scale.
    pdfViewer.currentScaleValue = "page-fit";
    
    var counter = document.getElementById("pdf-page-count");
    counter.innerText = counter.innerText.slice(0, -1) + pdfViewer.pagesCount;
    
    var stepper = document.getElementById("pdf-page-num");
    stepper.setAttribute("max", pdfViewer.pagesCount);
    stepper.onchange = function () {
        pdfViewer.currentPageNumber = parseInt(this.value);
    };
    
    document.getElementById("pdf-zoom-in").onclick = function () {
        pdfViewer.currentScale *= 1.1;
    };
    
    document.getElementById("pdf-zoom-out").onclick = function () {
        pdfViewer.currentScale /= 1.1;
    };
    
    document.getElementById("pdf-zoom-fit").onclick = function () {
        pdfViewer.currentScaleValue = "page-fit";
    };
});

eventBus.on("pagechanging", function () {
    document.getElementById("pdf-page-num").value = pdfViewer.currentPageNumber;
});

// Loading document.
const loadingTask = pdfjsLib.getDocument({
    url: DEFAULT_URL,
    cMapUrl: CMAP_URL,
    cMapPacked: CMAP_PACKED,
    enableXfa: ENABLE_XFA,
});
(async function () {
    const pdfDocument = await loadingTask.promise;
    // Document loaded, specifying document for the viewer and
    // the (optional) linkService.
    pdfViewer.setDocument(pdfDocument);

    pdfLinkService.setDocument(pdfDocument, null);
})();