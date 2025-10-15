/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./views/**/*.php",
    "./widgets/**/*.php",
    "./components/**/*.php",
    "./web/js/**/*.js",
    "./vendor/yiisoft/yii2/widgets/**/*.php",
    "./vendor/yiisoft/yii2-bootstrap*/**/*.php",
  ],
  theme: {
    extend: {
      keyframes: {
        "fade-in": {
          "0%": {
            opacity: "0",
            transform: "translateY(20px)",
          },
          "100%": {
            opacity: "1",
            transform: "translateY(0)",
          },
        },
      },
      animation: {
        "fade-in": "fade-in 0.5s ease-out",
      },
    },
  },
  plugins: [require("daisyui")],
  daisyui: {
    themes: ["light", "dark", "cupcake", "Synthwave", "Velentine", "Retro"],
  },
};
