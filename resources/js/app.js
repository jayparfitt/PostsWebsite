import 'livewire/livewire';

document.addEventListener("DOMContentLoaded", () => {
    // Select the buttons
    const enlargeButton = document.getElementById("text-enlarge");
    const minimizeButton = document.getElementById("text-minimize");
    const resetButton = document.getElementById("text-reset");
    const content = document.querySelector("body"); // Target the entire page content

    let fontSize = parseInt(localStorage.getItem("fontSize")) || 16; // Default font size

    // Apply saved font size on page load
    content.style.fontSize = `${fontSize}px`;

    // Enlarge Text
    enlargeButton?.addEventListener("click", () => {
        fontSize += 2;
        content.style.fontSize = `${fontSize}px`;
        localStorage.setItem("fontSize", fontSize); // Save preference
    });

    // Minimize Text
    minimizeButton?.addEventListener("click", () => {
        if (fontSize > 10) {
            fontSize -= 2;
            content.style.fontSize = `${fontSize}px`;
            localStorage.setItem("fontSize", fontSize); // Save preference
        }
    });

    // Reset Text
    resetButton?.addEventListener("click", () => {
        fontSize = 16;
        content.style.fontSize = `${fontSize}px`;
        localStorage.removeItem("fontSize"); // Clear preference
    });
});
