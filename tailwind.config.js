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
    extend: {},
  },
  plugins: [require("daisyui")],
  daisyui: {
    themes: ["light", "dark", "cupcake"],
  },
};
