<div class="ec-register-wrapper">
    <div class="ec-register-container p-2">
        <div class="toolbar ec-register-form">
            <!-- Bold, Italic, Underline Buttons -->
            <div class="btn-group">
                <button type="button" onclick="changeFontStyle('bold')">
                    <i class="fi-rr-bold"></i> <!-- Flaticon bold icon -->
                </button>
                <button type="button" onclick="changeFontStyle('italic')">
                    <i class="fi-rr-italic"></i> <!-- Flaticon italic icon -->
                </button>
                <button type="button" onclick="changeFontStyle('underline')">
                    <i class="fi-rr-underline"></i> <!-- Flaticon underline icon -->
                </button>
            </div>

            <!-- Font Size Adjuster -->
            <div class="font btn-group">
                <button type="button" onclick="changeFontSize('-')">
                    <i class="fi-rr-minus"></i> <!-- Eciicons minus icon -->
                </button>
                <span id="fontSizeDisplay">16px</span> <!-- Initially set to 16px -->
                <button type="button" onclick="changeFontSize('+')">
                    <i class="fi-rr-plus"></i> <!-- Eciicons plus icon -->
                </button>
            </div>

            <!-- Text and Background Color -->
            <div class="btn-group w-100">
                <div class="color-picker w-100">
                    <label for="textColor">Text Color</label>
                    <input id="textColor" type="color" onchange="changeTextColor(this.value)" title="Text Color" />
                </div>
                <div class="color-picker w-100">
                    <label for="backgroundColor">Background Color</label>
                    <input id="backgroundColor" type="color" onchange="changeBackgroundColor(this.value)" title="Background Color" />
                </div>
            </div>

            <!-- Font Family and Weight -->
            <div class="d-flex gap-2 w-100">
                <div class="ec-rg-select-inner mb-1">
                    <select class="ec-register-select" onchange="changeFontFamily(this.value)">
                        <option value="">Font</option>
                        <option value="Arial, sans-serif">Arial</option>
                        <option value="Courier New, Courier, monospace">Courier New</option>
                        <option value="Georgia, serif">Georgia</option>
                        <option value="Times New Roman, Times, serif">Times New Roman</option>
                        <option value="Verdana, sans-serif">Verdana</option>
                    </select>
                </div>
                <div class="ec-rg-select-inner mb-1">
                    <select class="ec-register-select" onchange="changeFontWeight(this.value)">
                        <option value="">Font Weight</option>
                        <option value="normal">Normal</option>
                        <option value="bold">Bold</option>
                        <option value="lighter">Lighter</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- <div id="editor" contenteditable="true"><p>Start typing your text here...</p></div> -->

<script>
    // Ensure selected content is wrapped inside a <p> tag
    function ensureParagraph() {
        let editor = document.getElementById('customTextPreview');
        if (editor.innerHTML.trim() === '') {
            editor.innerHTML = '<p>Design..</p>'; // Default content
        }

        // Wrap content in <p> if it's not wrapped already
        if (!editor.querySelector('p')) {
            let p = document.createElement('p');
            p.innerHTML = editor.innerHTML;
            editor.innerHTML = '';
            editor.appendChild(p);
        }
    }
    ensureParagraph()

    // Apply font style (italic, underline, etc.)
    function changeFontStyle(style) {
        ensureParagraph();
        document.execCommand(style, false, null);
    }

    // Adjust font size
    function changeFontSize(increment) {
        ensureParagraph();
        var fontSizeDisplay = document.getElementById('fontSizeDisplay');
        var currentSize = parseInt(fontSizeDisplay.textContent);

        if (increment === '+') {
            currentSize += 2;
        } else if (increment === '-') {
            currentSize -= 2;
        }

        fontSizeDisplay.textContent = currentSize + 'px';

        // Apply the font size directly to the <p> tag
        document.querySelector('p').style.fontSize = currentSize + 'px';
    }

    // Change text color
    function changeTextColor(color) {
        ensureParagraph();
        document.querySelector('p').style.color = color;
    }

    // Change background color
    function changeBackgroundColor(color) {
        ensureParagraph();
        document.querySelector('p').style.backgroundColor = color;
    }

    // Change font family
    function changeFontFamily(font) {
        ensureParagraph();
        document.querySelector('p').style.fontFamily = font;
    }

    // Change font weight
    function changeFontWeight(weight) {
        ensureParagraph();
        document.querySelector('p').style.fontWeight = weight;
    }
</script>