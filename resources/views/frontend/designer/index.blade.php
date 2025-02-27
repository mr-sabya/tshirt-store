@extends('frontend.layouts.app')

@section('content')

<livewire:frontend.components.breadcrumb title="T-Shirt Builder" />

<div class="ec-page-content section-space-p">
    <div class="container">
        <div class="custom-design">
            <div class="row">
                <!-- Controls -->
                <div class="col-md-4">
                    <h2 class="section-title">Customize Your T-Shirt</h2>

                    <!-- Select T-Shirt -->
                    <div class="form-group">
                        <h5>Select a T-Shirt</h5>
                        <div class="row mb-3" id="tshirt-container"></div>
                    </div>

                    <!-- Select Design -->
                    <div class="form-group">
                        <h5>Select a Design</h5>
                        <div class="row g-2 mb-3" id="design-container"></div>
                    </div>

                    <!-- Upload Design -->
                    <div class="form-group">
                        <h5>Upload Your Design</h5>
                        <input type="file" id="uploadedDesign" class="form-control mb-3">
                    </div>

                    <!-- Text Editor Controls -->
                    <div class="form-group">
                        <h5>Select Font</h5>
                        <select id="fontSelect" class="form-control">
                            <option value="Arial">Arial</option>
                            <option value="Georgia">Georgia</option>
                            <option value="Courier New">Courier New</option>
                            <option value="Times New Roman">Times New Roman</option>
                            <option value="Verdana">Verdana</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <h5>Select Font Size</h5>
                        <input type="number" id="fontSize" class="form-control" value="20" min="10" max="100">
                    </div>

                    <div class="form-group">
                        <h5>Select Text Color</h5>
                        <input type="color" id="textColor" class="form-control" value="#000000">
                    </div>

                    <!-- Buttons -->
                    <div class="button-group">
                        <button onclick="removeImage()" class="btn btn-warning mt-2">Remove Image</button>
                        <button onclick="resetCanvas()" class="btn btn-danger mt-2">Reset</button>
                    </div>
                </div>

                <!-- Canvas Area -->
                <div class="col-md-5">
                    <canvas id="tshirtCanvas" width="550" height="650" style="border:1px solid #ccc;"></canvas>
                    <button onclick="deleteSelectedDesign()" class="btn btn-danger">Delete Selected Design</button>
                </div>

                <!-- Text Customization -->
                <div class="col-lg-3">
                    <x-text-editor />
                    <input type="text" class="form-control mt-2 mb-2" id="text" placeholder="Enter text">
                    <div class="button-group">
                        <button onclick="addText()" class="btn btn-primary">Add Text</button>
                        <button onclick="removeText()" class="btn btn-warning">Remove Text</button>
                        <button onclick="updateTextProperties()" class="btn btn-info mt-2">Update Text</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/5.2.4/fabric.min.js"></script>
<script>
    let canvas = new fabric.Canvas('tshirtCanvas');

    // Define the fixed area (clipping region)
    const fixedArea = new fabric.Rect({
        left: 145, // X position of the fixed area
        top: 100, // Y position of the fixed area
        width: 250, // Width of the fixed area
        height: 400, // Height of the fixed area
        fill: 'transparent',
        stroke: 'rgba(255, 0, 0, 0.5)', // Optional: Visualize the fixed area
        strokeWidth: 2,
        selectable: false, // Prevent the fixed area from being moved
        evented: false // Prevent the fixed area from receiving events
    });

    // Add the fixed area to the canvas


    // Set the clipping region for the canvas
    // canvas.clipPath = fixedArea;

    function loadTShirts() {
        $.get('/api/tshirts', function(tshirts) {
            tshirts.forEach((tshirt, index) => {
                $('#tshirt-container').append(`
                    <div class="col-lg-4 tshirt-option-container">
                        <div class="tshirt-option" onclick="setTshirtBackground('${tshirt.image}')">
                            <img src="storage/${tshirt.image}" class="mb-2" alt="${tshirt.name}">
                        </div>
                    </div>
                `);
            });
        });
    }

    function loadDesigns() {
        $.get('/api/designs', function(designs) {
            designs.forEach((design, index) => {
                $('#design-container').append(`
                    <div class="col-lg-4 design-option-container">
                        <div class="design-option" onclick="setDesignPreview('${design.image}')">
                            <img src="storage/${design.image}" class="mb-2" alt="${design.name}">
                        </div>
                    </div>
                `);
            });
        });
    }

    function setTshirtBackground(imageSrc) {
        fabric.Image.fromURL('storage/' + imageSrc, function(img) {
            canvas.setBackgroundImage(img, canvas.renderAll.bind(canvas), {
                scaleX: canvas.width / img.width,
                scaleY: canvas.height / img.height
            });
        });
    }


    function setDesignPreview(imageSrc) {
        fabric.Image.fromURL('storage/' + imageSrc, function(img) {
            // Set the initial position and fixed width for the image
            const fixedWidth = 250; // Width of the fixed area
            const scaleX = fixedWidth / img.width;

            // Create the fixed area (make sure it stays at the top layer)
            const fixedArea = new fabric.Rect({
                left: 145, // X position of the fixed area
                top: 100, // Y position of the fixed area
                width: 250, // Width of the fixed area
                height: 400, // Height of the fixed area
                fill: 'transparent',
                stroke: 'rgba(255, 0, 0, 0.5)', // Optional: Visualize the fixed area
                strokeWidth: 2,
                selectable: false, // Prevent the fixed area from being moved
                evented: false // Prevent the fixed area from receiving events
            });

            // Add the fixed area to the canvas
            canvas.add(fixedArea);

            // Set image properties, scaling it based on the fixed width
            img.set({
                left: 145, // Initial position inside the fixed area (X position)
                top: 100, // Initial position inside the fixed area (Y position)
                scaleX: scaleX, // Scale width to fit the fixed width
                scaleY: scaleX, // Scale height proportionally
                selectable: true, // Allow the design to be moved and resized
                hasControls: true, // Show resize controls
                lockUniScaling: true, // Ensure uniform scaling (same aspect ratio)
                evented: true // Enable events so it can be interacted with
            });

            // Prevent image from moving outside the fixed area when dragging
            img.on('moving', function(e) {
                const fixedBounds = fixedArea.getBoundingRect();
                const imgBounds = img.getBoundingRect();

                // Smoothly restrict the image's movement to the fixed area with easing
                if (imgBounds.left < fixedBounds.left) {
                    img.animate('left', fixedBounds.left, {
                        duration: 100,
                        easing: fabric.util.ease.easeOutQuad
                    });
                }
                if (imgBounds.top < fixedBounds.top) {
                    img.animate('top', fixedBounds.top, {
                        duration: 100,
                        easing: fabric.util.ease.easeOutQuad
                    });
                }
                if (imgBounds.left + imgBounds.width > fixedBounds.left + fixedBounds.width) {
                    img.animate('left', fixedBounds.left + fixedBounds.width - imgBounds.width, {
                        duration: 100,
                        easing: fabric.util.ease.easeOutQuad
                    });
                }
                if (imgBounds.top + imgBounds.height > fixedBounds.top + fixedBounds.height) {
                    img.animate('top', fixedBounds.top + fixedBounds.height - imgBounds.height, {
                        duration: 100,
                        easing: fabric.util.ease.easeOutQuad
                    });
                }
            });

            // Add the design image to the canvas
            canvas.add(img);
            canvas.renderAll();
        });
    }



    function deleteSelectedDesign() {
        const selectedObject = canvas.getActiveObject();
        if (selectedObject) {
            // Check if the selected object is an image
            if (selectedObject.type === 'image') {
                canvas.remove(selectedObject);
                canvas.renderAll();
            } else {
                alert("Please select an image to delete.");
            }
        } else {
            alert("No design selected.");
        }
    }


    function addText() {
        let textValue = document.getElementById("text").value;
        let fontSize = document.getElementById("fontSize").value;
        let fontFamily = document.getElementById("fontSelect").value;
        let textColor = document.getElementById("textColor").value;

        if (!textValue.trim()) return;

        let text = new fabric.Text(textValue, {
            left: 100,
            top: 100,
            fontSize: parseInt(fontSize),
            fontFamily: fontFamily,
            fill: textColor,
            fontWeight: 'bold',
            selectable: true
        });

        canvas.add(text);
        canvas.renderAll();
    }

    function removeImage() {
        canvas.getObjects().forEach(obj => {
            if (obj.type === 'image') {
                canvas.remove(obj);
            }
        });
        canvas.renderAll();
    }

    function removeText() {
        canvas.getObjects().forEach(obj => {
            if (obj.type === 'text') {
                canvas.remove(obj);
            }
        });
        canvas.renderAll();
    }

    function resetCanvas() {
        canvas.clear();
        canvas.setBackgroundImage(null, canvas.renderAll.bind(canvas));
        // Re-add the fixed area after clearing the canvas
        canvas.add(fixedArea);
        // canvas.clipPath = fixedArea;
    }

    $(document).ready(function() {
        loadTShirts();
        loadDesigns();
    });
</script>

@endsection