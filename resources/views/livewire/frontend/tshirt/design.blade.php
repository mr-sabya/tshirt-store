<div class="custom-design">
    <div class="row">
        <!-- Controls -->
        <div class="col-md-4">
            <h2>Customize Your T-Shirt</h2>

            <!-- Select T-Shirt -->
            <h5>Select a T-Shirt</h5>
            <div class="mb-3">
                <div class="row">
                    @foreach ($tshirts as $tshirt)
                    <div class="col-lg-4">
                        <img src="{{ asset('storage/' . $tshirt->image) }}"
                            class="img-thumbnail mb-2 tshirt-option {{ $previewTshirt === $tshirt->image ? 'selected' : '' }}"
                            wire:click="selectTshirt('{{ $tshirt->image }}')"
                            alt="{{ $tshirt->name }}">
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Select Design -->
            <h5>Select a Design</h5>
            <div class="mb-3">
                <div class="row">
                    @foreach ($designs as $design)
                    <div class="col-lg-4">
                        <img src="{{ asset('storage/' . $design->image) }}"
                            class="img-thumbnail mb-2 design-option"
                            wire:click="selectDesign('{{ $design->image }}')"
                            alt="{{ $design->name }}">
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Upload Design -->
            <h5>Upload Your Design</h5>
            <input type="file" wire:model="uploadedDesign" class="form-control mb-3">

            <!-- Add Custom Text -->
            <h5>Add Custom Text</h5>
            <input type="text" wire:model="customText" class="form-control mb-3" placeholder="Enter your text">

            <!-- Reset -->
            <button wire:click="resetCanvas" class="btn btn-danger mt-2">Reset</button>
        </div>

        <!-- Canvas -->
        <div class="col-md-6">
            <div id="canvas" class="position-relative" style="width: 100%; height: 650px; border: 1px solid #ccc;">
                <!-- T-shirt Background -->
                @if ($previewTshirt)
                <img id="tshirtBackground" src="{{ asset('storage/' . $previewTshirt) }}"
                    alt="T-Shirt"
                    style="width: 100%; height: 100%; object-fit: cover;">
                @endif

                <!-- Design Preview -->
                @if ($previewDesign)
                <img id="designPreview" src="{{ url('storage', $previewDesign) }}"
                    class="position-absolute img-draggable"
                    style="top: 50%; left: 50%; width: 260px; height: 260px; transform: translate(-50%, -50%);">
                @endif

                <!-- Custom Text -->
                @if ($customText)
                <div id="customText" class="position-absolute img-draggable text-center"
                    style="top: 70%; left: 50%; transform: translate(-50%, -50%); font-size: 20px;">
                    {{ $customText }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('livewire:init', () => {
        // Function to initialize draggable and zoomable features
        function initializeInteractiveElements() {
            const draggableElements = document.querySelectorAll('.img-draggable');
            console.log(draggableElements);
            draggableElements.forEach((element) => {
                makeDraggable(element);
                makeZoomable(element);
            });
        }

        // Function to make an element draggable
        function makeDraggable(element) {
            let isDragging = false;
            let offsetX = 0,
                offsetY = 0;

            // Remove initial translation transform when dragging starts
            
            element.addEventListener('mousedown', (event) => {
                element.style.transform = "none"; // This removes translate(-50%, -50%) initially
                if (event.button === 0) { // Left mouse button only
                    isDragging = true;
                    let selectedElement = element;

                    // Set initial offsets for dragging
                    offsetX = event.clientX - element.getBoundingClientRect().left;
                    offsetY = event.clientY - element.getBoundingClientRect().top;

                    // Function to handle dragging
                    function onDrag(event) {
                        if (!isDragging) return;
                        const canvasRect = document.getElementById('canvas').getBoundingClientRect();
                        let newLeft = event.clientX - canvasRect.left - offsetX;
                        let newTop = event.clientY - canvasRect.top - offsetY;

                        // Constrain the element within the canvas bounds
                        newLeft = Math.max(0, Math.min(newLeft, canvasRect.width - selectedElement.offsetWidth));
                        newTop = Math.max(0, Math.min(newTop, canvasRect.height - selectedElement.offsetHeight));

                        // Update position of the element
                        selectedElement.style.left = newLeft + 'px';
                        selectedElement.style.top = newTop + 'px';
                    }

                    // Function to stop dragging
                    function stopDrag() {
                        isDragging = false;
                        // Optionally, restore the transform property if needed
                        // selectedElement.style.transform = "translate(-50%, -50%)"; // Re-add if needed

                        document.removeEventListener('mousemove', onDrag);
                        document.removeEventListener('mouseup', stopDrag);
                    }

                    // Add event listeners for dragging
                    document.addEventListener('mousemove', onDrag);
                    document.addEventListener('mouseup', stopDrag);
                }
            });
        }


        // Function to make an element zoomable
        function makeZoomable(element) {
            let scale = 1;
            element.addEventListener('wheel', (event) => {
                event.preventDefault();
                const zoomStep = 0.1;
                scale += event.deltaY > 0 ? -zoomStep : zoomStep;
                scale = Math.max(0.5, Math.min(scale, 3)); // Clamp scale between 0.5 and 3
                element.style.transform = `scale(${scale})`;
            });
        }

        // Re-initialize draggable and zoomable elements when images are clicked
        Livewire.on('tshirtOrDesignSelected', () => {
            initializeInteractiveElements();
        });

        // Initialize interactive elements on page load


        // Trigger re-initialization after image click (Livewire event or image click handler)
        document.querySelectorAll('.tshirt-option, .design-option').forEach((img) => {
            img.addEventListener('click', () => {
                console.log('click');
                // Emitting an event to Livewire with image src
                Livewire.dispatch('tshirtOrDesignSelected', {
                    imageSrc: img.src
                }); // Passing image src as data to Livewire
            });
        });
    });
</script>