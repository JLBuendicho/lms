import "mathlive";
// import katex from "katex";
import renderMathInElement from "katex/contrib/auto-render";
import "katex/dist/katex.min.css";

function renderLatex() {
    console.log("renderLatex running");

    document.querySelectorAll(".latex").forEach((el) => {
        console.log("Rendering:", el.textContent);
        if (el.dataset.katexRendered) return;

        renderMathInElement(el, {
            delimiters: [
                { left: "$$", right: "$$", display: true },
                { left: "$", right: "$", display: false },
            ],
            throwOnError: false,
        });

        el.dataset.katexRendered = "true";
    });
}

document.addEventListener("DOMContentLoaded", renderLatex);

document.addEventListener("livewire:init", () => {
    renderLatex();

    Livewire.hook("commit", () => {
        queueMicrotask(() => renderLatex());
    });
});

// Livewire / Filament re-renders DOM dynamically
document.addEventListener("livewire:navigated", () => {
    renderLatex();
});

// Only start Alpine if it's not already running (e.g., on a non-Filament page)
// Filament handles starting Alpine itself for the admin panel.
if (typeof window.Alpine === "undefined") {
    import("alpinejs").then(({ default: Alpine }) => {
        window.Alpine = Alpine;
        Alpine.start();
    });
}
