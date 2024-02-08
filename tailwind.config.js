/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./assets/**/*.{js,jsx}", "./templates/**/*.html.twig"],
  theme: {
    extend: {},
  },
  plugins: [require("@tailwindcss/typography"), require("@tailwindcss/forms")],
};
