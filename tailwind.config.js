import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";
import typography from "@tailwindcss/typography";
import aspectRatio from "@tailwindcss/aspect-ratio";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.{js,ts,jsx,tsx}",
        "node_modules/flowbite/**/*.js",
        "node_modules/flowbite-react/**/*.{js,ts,jsx,tsx}",
    ],
    theme: {
        container: {
            center: true,
            padding: {
                DEFAULT: "1rem",
                sm: "2rem",
                lg: "3rem",
                xl: "4rem",
                "2xl": "5rem",
            },
        },
        extend: {
            screens: {
                xs: "360px", // optional custom breakpoint
                sm: "640px",
                md: "768px",
                lg: "1024px",
                xl: "1280px",
                "2xl": "1536px",
                "3xl": "1920px", // optional
                "4xl": "2560px", // optional
            },
            colors: {
                primary: "#044335",
                secondary: "#03624C",
                accent: "#FFF32F",
                background: {
                    primary: "#ffffff",
                    secondary: "#f8f9fa",
                },
                dark: "#0f172a",
                light: "#f9fafb",
                success: "#16a34a",
                warning: "#f59e0b",
                danger: "#dc2626",
                info: "#0284c7",
                muted: "#6b7280",
                transparent: "transparent",
                current: "currentColor",
                custom: {
                    green: "#044335",
                    yellow: "#FFF32F",
                },
            },
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
                heading: ["Poppins", "sans-serif"],
                serif: ["Merriweather", "serif"],
                mono: ["Fira Code", "monospace"],
            },
            fontSize: {
                xs: ["0.75rem", { lineHeight: "1rem" }],
                sm: ["0.875rem", { lineHeight: "1.25rem" }],
                base: ["1rem", { lineHeight: "1.5rem" }],
                lg: ["1.125rem", { lineHeight: "1.75rem" }],
                xl: ["1.25rem", { lineHeight: "1.75rem" }],
                "2xl": ["1.5rem", { lineHeight: "2rem" }],
                "3xl": ["1.875rem", { lineHeight: "2.25rem" }],
                "4xl": ["2.25rem", { lineHeight: "2.5rem" }],
                "5xl": ["3rem", { lineHeight: "1" }],
                "6xl": ["3.75rem", { lineHeight: "1" }],
                "7xl": ["4.5rem", { lineHeight: "1" }],
                "8xl": ["6rem", { lineHeight: "1" }],
            },
            borderRadius: {
                none: "0",
                sm: "0.125rem",
                DEFAULT: "0.25rem",
                md: "0.375rem",
                lg: "0.5rem",
                xl: "0.75rem",
                "2xl": "1rem",
                "3xl": "1.5rem",
                "5xl": "5rem",
                full: "9999px",
            },
            boxShadow: {
                sm: "0 1px 2px 0 rgba(0,0,0,0.05)",
                DEFAULT:
                    "0 1px 3px 0 rgba(0,0,0,0.1), 0 1px 2px 0 rgba(0,0,0,0.06)",
                md: "0 4px 6px -1px rgba(0,0,0,0.1), 0 2px 4px -1px rgba(0,0,0,0.06)",
                lg: "0 10px 15px -3px rgba(0,0,0,0.1), 0 4px 6px -2px rgba(0,0,0,0.05)",
                xl: "0 20px 25px -5px rgba(0,0,0,0.1), 0 10px 10px -5px rgba(0,0,0,0.04)",
                "2xl": "0 25px 50px -12px rgba(0,0,0,0.25)",
                inner: "inset 0 2px 4px 0 rgba(0,0,0,0.06)",
                none: "none",
            },
            backgroundImage: {
                "gradient-primary":
                    "linear-gradient(to right, #044335, #03624C)",
                "gradient-accent": "linear-gradient(135deg, #FFF32F, #FFD700)",
                "gradient-dark": "linear-gradient(to bottom, #0f172a, #1e293b)",
            },
            keyframes: {
                fadeIn: { "0%": { opacity: 0 }, "100%": { opacity: 1 } },
                fadeOut: { "0%": { opacity: 1 }, "100%": { opacity: 0 } },
                slideUp: {
                    "0%": { transform: "translateY(100%)" },
                    "100%": { transform: "translateY(0)" },
                },
                bounceX: {
                    "0%, 100%": { transform: "translateX(0)" },
                    "50%": { transform: "translateX(-20px)" },
                },
            },
            animation: {
                fadeIn: "fadeIn 1s ease-in-out",
                fadeOut: "fadeOut 1s ease-in-out",
                slideUp: "slideUp 1s ease-in-out",
                bounceX: "bounceX 2s infinite",
            },
            transitionDuration: {
                0: "0ms",
                75: "75ms",
                100: "100ms",
                150: "150ms",
                200: "200ms",
                300: "300ms",
                500: "500ms",
                700: "700ms",
                1000: "1000ms",
            },
            zIndex: {
                auto: "auto",
                0: 0,
                10: 10,
                20: 20,
                30: 30,
                40: 40,
                50: 50,
                100: 100,
                999: 999,
                9999: 9999,
            },
            spacing: { 128: "32rem", 144: "36rem", 160: "40rem", 200: "50rem" },
        },
    },
    plugins: [
        forms,
        require('@tailwindcss/typography'),
        aspectRatio,
        require("flowbite/plugin")],
};
