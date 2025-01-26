@extends('frontend.layouts.app')

@section('content')
<div class="ec-breadcrumb section-space-mb">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row ec_breadcrumb_inner">
                    <div class="col-md-6 col-sm-12">
                        <h2 class="ec-breadcrumb-title">Shop</h2>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <ul class="ec-breadcrumb-list">
                            <li class="ec-breadcrumb-item"><a href="index.html">Home</a></li>
                            <li class="ec-breadcrumb-item active">Shop</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

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
                        <div class="row mb-3" id="design-container"></div>
                    </div>

                    <!-- Upload Design -->
                    <div class="form-group">
                        <h5>Upload Your Design</h5>
                        <input type="file" id="uploadedDesign" class="form-control mb-3">
                    </div>

                    <!-- Buttons -->
                    <div class="button-group">
                        <button id="removeImage" class="btn btn-warning mt-2">Remove Image</button>
                        <button id="removeText" class="btn btn-warning mt-2">Remove Text</button>
                        <button id="resetCanvas" class="btn btn-danger mt-2">Reset</button>
                    </div>
                </div>

                <!-- Canvas Area -->
                <div class="col-md-5">
                    <div id="canvas" class="position-relative" style="width: 100%; height: 650px; border: 1px solid #ccc;">
                        <!-- T-shirt Background -->
                        <img id="tshirtBackground" class="d-none" alt="T-Shirt" style="width: 100%; height: 100%; object-fit: cover;">

                        <!-- Design Preview -->
                        <img id="designPreview" class="position-absolute img-draggable d-none" style="width: 260px; height: 260px;">

                        <!-- Custom Text -->
                        <div id="customTextPreview" class="position-absolute img-draggable text-center d-none" style="font-size: 20px;"></div>

                        <!-- Zoom Controller -->
                        <div id="zoomController" class="d-none">
                            <label for="zoomRange" style="color: #000;">Zoom:</label>
                            <input type="range" class="w-100" id="zoomRange" min="0.5" max="3" step="0.1" value="1">
                        </div>
                    </div>
                </div>

                <!-- Text Customization -->
                <div class="col-lg-3">
                    <div class="form-group">
                        <h5>Add Custom Text</h5>
                        <input type="text" id="customText" class="form-control mb-3" placeholder="Enter your text">
                    </div>

                    <!-- Font Size Control -->
                    <div class="form-group">
                        <h5>Font Size</h5>
                        <input type="range" id="fontSize" class="form-control mb-3" min="10" max="100" value="20">
                    </div>

                    <!-- Font Color Control -->
                    <div class="form-group">
                        <h5>Font Color</h5>
                        <input type="color" id="fontColor" class="form-control mb-3" value="#000000">
                    </div>

                    <!-- Font Family Control -->
                    <div class="form-group">
                        <h5>Font Family</h5>
                        <select id="fontFamily" class="form-control mb-3">
                            <option value="Arial">Arial</option>
                            <option value="Courier New">Courier New</option>
                            <option value="Georgia">Georgia</option>
                            <option value="Tahoma">Tahoma</option>
                            <option value="Verdana">Verdana</option>
                            <option value="Times New Roman">Times New Roman</option>
                            <option value="Comic Sans MS">Comic Sans MS</option>
                            <option value="Lucida Console">Lucida Console</option>
                            <option value="Impact">Impact</option>
                            <option value="Helvetica">Helvetica</option>
                            <option value="Arial Black">Arial Black</option>
                            <option value="Brush Script MT">Brush Script MT</option>
                            <option value="Frank Ruhl Libre">Frank Ruhl Libre</option>
                            <option value="Dancing Script">Dancing Script</option>
                            <option value="Pacifico">Pacifico</option>
                            <option value="Lobster">Lobster</option>
                            <option value="Monaco">Monaco</option>
                            <option value="Roboto">Roboto</option>
                            <option value="Open Sans">Open Sans</option>
                            <option value="Montserrat">Montserrat</option>
                            <option value="Playfair Display">Playfair Display</option>
                        </select>
                    </div>


                    <!-- Font Weight Control -->
                    <div class="form-group">
                        <h5>Font Weight</h5>
                        <select id="fontWeight" class="form-control mb-3">
                            <option value="normal">Normal</option>
                            <option value="bold">Bold</option>
                            <option value="bolder">Bolder</option>
                            <option value="lighter">Lighter</option>
                        </select>
                    </div>

                    <!-- Text Position Controls -->
                    <div class="form-group">
                        <h5>Text Position</h5>
                        <select id="textPosition" class="form-control mb-3">
                            <option value="center">Center</option>
                            <option value="top-left">Top Left</option>
                            <option value="top-right">Top Right</option>
                            <option value="bottom-left">Bottom Left</option>
                            <option value="bottom-right">Bottom Right</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')

<script>
    $(document).ready(function() {
        const canvas = $('#canvas');

        // Load Initial Content
        loadTShirts();
        loadDesigns();

        // Event Listeners
        setupEventListeners();

        // Initialization Functions
        function loadTShirts() {
            $.get('/api/tshirts', function(tshirts) {
                tshirts.forEach(tshirt => {
                    $('#tshirt-container').append(
                        `<div class="col-lg-4"><img src="storage/${tshirt.image}" class="img-thumbnail mb-2 tshirt-option" data-image="${tshirt.image}" alt="${tshirt.name}"></div>`
                    );
                });

                // Set the first T-shirt as default
                if (tshirts.length > 0) {
                    setTshirtBackground(tshirts[0].image);
                }
            });
        }

        function loadDesigns() {
            $.get('/api/designs', function(designs) {
                designs.forEach(design => {
                    $('#design-container').append(
                        `<div class="col-lg-4"><img src="storage/${design.image}" class="img-thumbnail mb-2 design-option" data-image="${design.image}" alt="${design.name}"></div>`
                    );
                });
            });
        }

        function setupEventListeners() {
            // T-shirt selection
            $(document).on('click', '.tshirt-option', function() {
                const imageSrc = $(this).data('image');
                setTshirtBackground(imageSrc);
            });

            // Design selection
            $(document).on('click', '.design-option', function() {
                const imageSrc = $(this).data('image');
                setDesignPreview(imageSrc);
            });

            // Zoom range input
            $('#zoomRange').on('input', function() {
                updateZoom($(this).val());
            });

            // Custom text input
            $('#customText').on('input', function() {
                updateCustomText($(this).val());
            });

            // Font size input
            $('#fontSize').on('input', function() {
                updateFontSize($(this).val());
            });

            // Font color input
            $('#fontColor').on('input', function() {
                updateFontColor($(this).val());
            });

            // Font family select
            $('#fontFamily').on('change', function() {
                updateFontFamily($(this).val());
            });

            // Font weight select
            $('#fontWeight').on('change', function() {
                updateFontWeight($(this).val());
            });

            // Text position select
            $('#textPosition').on('change', function() {
                updateTextPosition($(this).val());
            });

            // Custom design upload
            $('#uploadedDesign').on('change', function(e) {
                handleDesignUpload(e.target.files[0]);
            });

            // Reset button
            $('#resetCanvas').on('click', function() {
                resetCanvas();
            });

            // Remove image button
            $('#removeImage').on('click', function() {
                removeImage();
            });

            // Remove text button
            $('#removeText').on('click', function() {
                removeText();
            });

            // Draggable design and text
            interact('.img-draggable')
                .draggable({
                    modifiers: [
                        interact.modifiers.restrictRect({
                            restriction: '#canvas',
                            endOnly: true,
                        }),
                    ],
                    listeners: {
                        move(event) {
                            const target = event.target;
                            const x = (parseFloat(target.getAttribute('data-x')) || 0) + event.dx;
                            const y = (parseFloat(target.getAttribute('data-y')) || 0) + event.dy;

                            target.style.transform = `translate(${x}px, ${y}px) scale(${target.getAttribute('data-scale') || 1})`;

                            target.setAttribute('data-x', x);
                            target.setAttribute('data-y', y);
                        },
                    },
                });
        }

        // T-shirt Background Handler
        function setTshirtBackground(imageSrc) {
            $('#tshirtBackground').attr('src', 'storage/' + imageSrc).removeClass('d-none');
        }

        // Design Preview Handler
        function setDesignPreview(imageSrc) {
            const designPreview = $('#designPreview');
            const zoomController = $('#zoomController');

            designPreview.attr('src', 'storage/' + imageSrc).removeClass('d-none');

            zoomController.removeClass('d-none');

            // Reset zoom
            designPreview.css('transform', 'translate(-50%, -50%) scale(1)');
            $('#zoomRange').val(1);
        }

        // Zoom Handler
        function updateZoom(zoomLevel) {
            $('#designPreview').css('transform', `translate(-50%, -50%) scale(${zoomLevel})`);
        }

        // Custom Text Handler
        function updateCustomText(text) {
            $('#customTextPreview').text(text).removeClass('d-none');
        }

        // Font Size Handler
        function updateFontSize(size) {
            $('#customTextPreview').css('font-size', `${size}px`);
        }

        // Font Color Handler
        function updateFontColor(color) {
            $('#customTextPreview').css('color', color);
        }

        // Font Family Handler
        function updateFontFamily(fontFamily) {
            $('#customTextPreview').css('font-family', fontFamily);
        }

        // Font Weight Handler
        function updateFontWeight(weight) {
            $('#customTextPreview').css('font-weight', weight);
        }

        // Text Position Handler
        function updateTextPosition(position) {
            const textPreview = $('#customTextPreview');
            if (position === 'left') {
                textPreview.css('left', '10px');
                textPreview.css('right', 'auto');
                textPreview.css('text-align', 'left');
            } else if (position === 'right') {
                textPreview.css('right', '10px');
                textPreview.css('left', 'auto');
                textPreview.css('text-align', 'right');
            } else {
                textPreview.css('left', '50%');
                textPreview.css('right', 'auto');
                textPreview.css('text-align', 'center');
                textPreview.css('transform', 'translateX(-50%)');
            }
        }

        // Design Upload Handler
        function handleDesignUpload(file) {
            const formData = new FormData();
            formData.append('uploadedDesign', file);

            $.ajax({
                url: '/api/upload-design',
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    setDesignPreview(response.url);
                },
                error: function() {
                    alert('Failed to upload design.');
                },
            });
        }

        // Canvas Reset Handler
        function resetCanvas() {
            $('#designPreview').addClass('d-none').css('transform', 'translate(-50%, -50%) scale(1)');
            $('#zoomController').addClass('d-none');
            $('#customTextPreview').addClass('d-none').text('');
            $('#uploadedDesign').val('');
            $('#customText').val('');
        }

        // Remove Image Handler
        function removeImage() {
            $('#designPreview').addClass('d-none').css('transform', 'translate(-50%, -50%) scale(1)');
            $('#zoomController').addClass('d-none');
        }

        // Remove Text Handler
        function removeText() {
            $('#customTextPreview').addClass('d-none').text('');
        }
    });
</script>
@endsection