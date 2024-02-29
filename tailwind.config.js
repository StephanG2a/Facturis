/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./assets/**/*.{js,jsx}", "./templates/**/*.html.twig"],
  darkMode: "class",
  theme: {
    extend: {},
  },
  plugins: [require("@tailwindcss/typography"), require("@tailwindcss/forms")],
};
