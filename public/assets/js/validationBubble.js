const footerHeight = document.getElementById('footer').offsetHeight;
let validationBubble; // Variable to store the validation bubble reference

export function showValidationBubble(element, message) {
    // Remove existing validation bubble if any
    removeValidationBubble();

    // Create a bubble element
    validationBubble = document.createElement('div');
    validationBubble.className = 'validation-bubble';
    validationBubble.textContent = message;

    // Append the bubble to the body to ensure it's not affected by parent positioning
    document.body.appendChild(validationBubble);

    // Position the bubble below the element, considering scroll position
    positionValidationBubble(element);

    // Listen for window resize event to recalculate the bubble's position
    window.addEventListener('resize', function () {
        positionValidationBubble(element);
    });

    // Remove the bubble after 3000 milliseconds
    setTimeout(function () {
        removeValidationBubble();
    }, 3000);
}

// Function to remove the validation bubble
function removeValidationBubble() {
    if (validationBubble && validationBubble.parentNode) {
        validationBubble.parentNode.removeChild(validationBubble);
        validationBubble = null;
    }
}

// Function to position the validation bubble
function positionValidationBubble(element) {
    // Bounding rectangle of the specified element, representing its size and position relative to the viewport
    const elementRect = element.getBoundingClientRect();
    // Vertical scroll position of the window, accounting for browser differences
    const scrollTop = window.scrollY || document.documentElement.scrollTop;
    
    // Calculate the position, considering padding and border of the specified element
    const elementStyle = getComputedStyle(element);
    const elementBorderTop = parseFloat(elementStyle.borderTopWidth);
    const elementBorderBottom = parseFloat(elementStyle.borderBottomWidth);

    // Calculate the bottom position of the validation bubble
    const bubbleBottom = elementRect.bottom + scrollTop + elementBorderTop;

    // Check if the bubble would overlap with the footer
    if (bubbleBottom + validationBubble.offsetHeight > window.innerHeight - footerHeight) {
        // Reposition the bubble above the specified element
        validationBubble.classList.add('above');
        validationBubble.style.top = elementRect.top + scrollTop - validationBubble.offsetHeight - elementBorderTop + 'px';
    } else {
        // Position it below the specified element
        validationBubble.classList.remove('above');
        validationBubble.style.top = elementRect.bottom + scrollTop + elementBorderBottom + 'px';
    }

    // Left position of the validation bubble to align with the left side of the specified element
    validationBubble.style.left = elementRect.left + 'px';
}