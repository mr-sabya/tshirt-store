@extends('frontend.layouts.app')

@section('content')

<livewire:frontend.components.breadcrumb title="T-Shirt Builder" addMargin="0" />

<div class="hero">
    <div class="container">
        <div class="hero-content">
            <h1 class="hero-title">Custom T-Shirt Builder</h1>
            <p class="hero-text">Design your own custom t-shirt with our easy-to-use online t-shirt builder.</p>
        </div>
    </div>
</div>

<div class="ec-page-content section-space-p">
    <div class="container">

        <div class="custom-design">
            <div class="row">
                <!-- Controls -->
                <div class="col-md-4">
                    <div class="image-loader">

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

                        <!-- Buttons -->
                        <div class="button-group">
                            <button onclick="removeImage()" class="btn btn-warning mt-2">Remove Image</button>
                            <button onclick="resetCanvas()" class="btn btn-danger mt-2">Reset</button>
                        </div>
                    </div>
                </div>

                <!-- Canvas Area -->
                <div class="col-md-5">
                    <canvas id="tshirtCanvas" width="550" height="650" style="border:1px solid #ccc;"></canvas>
                    <div class="mt-3">
                        <button onclick="deleteSelectedDesign()" class="btn btn-danger">Delete Selected Design</button>
                    </div>
                </div>

                <!-- Text Customization -->
                <div class="col-lg-3">

                    <!-- Text Editor Section -->
                    <!-- Text Editor Section -->
                    <div class="text-editor">
                        <h2 class="section-title">Add Text</h2>

                        <!-- Custom Text Editor -->
                        <div class="form-group">
                            <label for="textInput">Enter Text</label>
                            <input type="text" id="textInput" class="input-text" placeholder="Enter your text here" oninput="updateTextOnCanvas()" />
                        </div>

                        <!-- Font Family -->
                        <div class="form-group">
                            <label for="fontSelect">Select Font</label>
                            <select id="fontSelect" class="select-box" onchange="updateTextOnCanvas()">
                                <option value="Arial">Arial</option>
                                <option value="Georgia">Georgia</option>
                                <option value="Courier New">Courier New</option>
                                <option value="Times New Roman">Times New Roman</option>
                                <option value="Verdana">Verdana</option>
                            </select>
                        </div>
                        <div class="d-flex gap-2">

                            <!-- Font Size -->
                            <div class="form-group w-100">
                                <input type="number" id="fontSize" class="input-text" value="30" min="10" max="100" onchange="updateTextOnCanvas()" />
                            </div>

                            <!-- Text Color -->
                            <div class="form-group w-100">
                                <input type="color" id="textColor" class="input-text" value="#000000" onchange="updateTextOnCanvas()" />
                            </div>



                            <!-- Font Weight (Bold/Normal) -->
                            <div class="form-group w-100">
                                <button class="btn-action" id="boldBtn" onclick="toggleBold()">
                                    <i class="fas fa-bold"></i> Bold
                                </button>
                            </div>
                        </div>

                        <!-- Text Alignment -->
                        <div class="form-group">
                            <div class="alignment-btns gap-2">
                                <button class="btn-action" onclick="setTextAlign('left')">
                                    <i class="fas fa-align-left"></i> Left
                                </button>
                                <button class="btn-action" onclick="setTextAlign('center')">
                                    <i class="fas fa-align-center"></i> Center
                                </button>
                                <button class="btn-action" onclick="setTextAlign('right')">
                                    <i class="fas fa-align-right"></i> Right
                                </button>
                            </div>
                        </div>

                        <!-- Add Text Button -->
                        <div class="form-group">
                            <button class="btn-action btn-add" onclick="addText()">
                                <i class="fas fa-plus-circle"></i> Add Text
                            </button>
                        </div>

                        <!-- Remove Text Button -->
                        <div class="form-group">
                            <button onclick="removeText()" class="btn-action btn-remove">
                                <i class="fas fa-trash-alt"></i> Remove Text
                            </button>
                        </div>
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
    let currentText = null;

    // Define the fixed area (clipping region)
    // Hide fixed area initially
    let fixedArea = null;

    // Function to create the fixed area
    function createFixedArea() {
        if (!fixedArea) {
            fixedArea = new fabric.Rect({
                left: 145,
                top: 100,
                width: 250,
                height: 400,
                fill: 'transparent',
                stroke: 'rgba(255, 0, 0, 0.5)', // Visualize the fixed area
                strokeWidth: 2,
                selectable: false, // Prevent the fixed area from being moved
                evented: false // Prevent the fixed area from receiving events
            });

            // Add fixed area to the canvas
            canvas.add(fixedArea);
        }
    }

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


            // Add the first T-shirt to the canvas after loading the T-shirt options
            if (tshirts.length > 0) {
                setTshirtBackground(tshirts[0].image); // Set the first T-shirt as the background
            }
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


            // Add the first design to the canvas after loading the design options
            if (designs.length > 0) {
                setDesignPreview(designs[0].image); // Set the first design as the preview on the canvas
            }
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

            // Add the fixed area to the canvas
            createFixedArea();

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



    function removeImage() {
        canvas.getObjects().forEach(obj => {
            if (obj.type === 'image') {
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


    // add text

    // Function to create a new text object and add to the canvas
    function addText() {
        let textValue = document.getElementById("textInput").value;
        let fontSize = document.getElementById("fontSize").value;
        let fontFamily = document.getElementById("fontSelect").value;
        let textColor = document.getElementById("textColor").value;

        if (!textValue.trim()) return; // Don't add empty text

        let text = new fabric.Text(textValue, {
            fontSize: parseInt(fontSize),
            fontFamily: fontFamily,
            fill: textColor,
            fontWeight: 'normal',
            textAlign: 'left',
            selectable: true
        });

        let leftPosition = (canvas.width - text.width) / 2;

        text.set({
            left: leftPosition, // Set the left position to the calculated value
            top: 100 // You can adjust the vertical position as needed
        });

        canvas.add(text);

        // Show fixed area after adding text
        createFixedArea();

        // Constrain the text movement within the fixed area
        // Constrain the text movement within the fixed area
        text.on('moving', function(e) {
            const fixedBounds = fixedArea.getBoundingRect();
            const textBounds = text.getBoundingRect();

            // Smoothly restrict the text's movement to the fixed area with easing
            if (textBounds.left < fixedBounds.left) {
                text.animate('left', fixedBounds.left, {
                    duration: 100,
                    easing: fabric.util.ease.easeOutQuad
                });
            }
            if (textBounds.top < fixedBounds.top) {
                text.animate('top', fixedBounds.top, {
                    duration: 100,
                    easing: fabric.util.ease.easeOutQuad
                });
            }
            if (textBounds.left + textBounds.width > fixedBounds.left + fixedBounds.width) {
                text.animate('left', fixedBounds.left + fixedBounds.width - textBounds.width, {
                    duration: 100,
                    easing: fabric.util.ease.easeOutQuad
                });
            }
            if (textBounds.top + textBounds.height > fixedBounds.top + fixedBounds.height) {
                text.animate('top', fixedBounds.top + fixedBounds.height - textBounds.height, {
                    duration: 100,
                    easing: fabric.util.ease.easeOutQuad
                });
            }
        });


        currentText = text;
        canvas.renderAll();
    }

    // Real-time update of text on canvas
    function updateTextOnCanvas() {
        if (!currentText) return; // No text to update

        // Update the text properties from the form
        let textValue = document.getElementById("textInput").value;
        let fontSize = document.getElementById("fontSize").value;
        let fontFamily = document.getElementById("fontSelect").value;
        let textColor = document.getElementById("textColor").value;

        currentText.set({
            text: textValue,
            fontSize: parseInt(fontSize),
            fontFamily: fontFamily,
            fill: textColor
        });

        canvas.renderAll();
    }

    // Toggle bold style for text
    function toggleBold() {
        if (currentText) {
            currentText.set({
                fontWeight: currentText.fontWeight === 'bold' ? 'normal' : 'bold'
            });
            document.getElementById('boldBtn').classList.toggle('btn-primary');
            canvas.renderAll();
        }
    }

    // Set text alignment (left, center, right)
    function setTextAlign(align) {
        if (currentText) {
            currentText.set({
                textAlign: align
            });
            canvas.renderAll();
        }
    }

    // Function to remove text from the canvas
    function removeText() {
        if (currentText) {
            canvas.remove(currentText);
            currentText = null;
        }
    }

    // Add initial text when ready
    document.addEventListener('DOMContentLoaded', function() {
        addText(); // This will add a default text when the page loads
    });

    $(document).ready(function() {
        loadTShirts();
        loadDesigns();
    });
</script>

@endsection