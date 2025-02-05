@extends('frontend.layouts.app')

@section('content')

<livewire:frontend.components.breadcrumb title="T-Shirt Builder"  />

<div class="ec-page-content section-space-p">
    <div class="container">
        <div class="custom-design ">
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

                    <!-- Buttons -->
                    <div class="button-group">
                        <button id="removeImage" class="btn btn-warning mt-2">Remove Image</button>

                        <button id="resetCanvas" class="btn btn-danger mt-2">Reset</button>
                    </div>
                </div>

                <!-- Canvas Area -->
                <div class="col-md-5">
                    <div id="canvas" class="position-relative" style="width: 100%; height: 650px; border: 1px solid #ccc;">
                        <!-- T-shirt Background -->
                        <img id="tshirtBackground" class="d-none" alt="T-Shirt" style="width: 100%; height: 100%; object-fit: cover;">

                        <!-- Design Preview -->
                        <img id="designPreview" class="position-absolute img-draggable d-none" style="width: 195px;">

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

                    <x-text-editor />
                    <input type="text" class="form-control mt-2 mb-2" id="text">
                    <div class="button-group">
                        <button type="button" class="btn btn-primary" id="addtext">Add text</button>
                        <button id="removeText" class="btn btn-warning">Remove Text</button>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- Include TinyMCE Script -->

<script>
    $(document).ready(function() {
        const canvas = $('#canvas');

        // Load Initial Content
        loadTShirts();
        loadDesigns();

        // Event Listeners
        setupEventListeners();

        $('#addtext').on('click', function() {
            console.log('click');
            let editorContent = $('#text').val();
            console.log(editorContent);
            updateCustomText(editorContent);
        });

        // Initialization Functions
        function loadTShirts() {
            $.get('/api/tshirts', function(tshirts) {
                tshirts.forEach((tshirt, index) => {
                    $('#tshirt-container').append(
                        `<div class="col-lg-4 tshirt-option-container">
                        <div class="tshirt-option" data-image="${tshirt.image}">
                            <img src="storage/${tshirt.image}" class="mb-2" alt="${tshirt.name}">
                        </div>
                    </div>`
                    );
                });

                // Set the first T-shirt as default and add active class
                if (tshirts.length > 0) {
                    const firstTshirt = $('#tshirt-container .tshirt-option-container').first();
                    firstTshirt.addClass('active');
                    setTshirtBackground(tshirts[0].image);
                }
            });
        }

        function loadDesigns() {
            $.get('/api/designs', function(designs) {
                designs.forEach((design, index) => {
                    $('#design-container').append(
                        `<div class="col-lg-4 design-option-container">
                        <div class="design-option" data-image="${design.image}">
                            <img src="storage/${design.image}" class="mb-2" alt="${design.name}">
                        </div>
                    </div>`
                    );
                });

                // Set the first design as default and add active class
                if (designs.length > 0) {
                    const firstDesign = $('#design-container .design-option-container').first();
                    firstDesign.addClass('active');
                    setDesignPreview(designs[0].image);
                }
            });
        }

        function setupEventListeners() {
            // T-shirt selection
            $(document).on('click', '.tshirt-option-container', function() {
                $('.tshirt-option-container').removeClass('active'); // Remove active class from all T-shirt containers
                $(this).addClass('active'); // Add active class to the clicked T-shirt container
                const imageSrc = $(this).find('.tshirt-option').data('image');
                setTshirtBackground(imageSrc);
            });

            // Design selection
            $(document).on('click', '.design-option-container', function() {
                $('.design-option-container').removeClass('active'); // Remove active class from all design containers
                $(this).addClass('active'); // Add active class to the clicked design container
                const imageSrc = $(this).find('.design-option').data('image');
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
            $('#customTextPreview').removeClass('d-none');
            $('#customTextPreview').html('');
            $('#customTextPreview').html('<p>' + text + '</p>');
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
            $('#text').val('');
        }
    });
</script>
@endsection