const defaultTheme = require("tailwindcss/defaultTheme");

module.exports = {
  darkMode: "media",
  purge: {
    enabled: true,
    content: [
      "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
      "./storage/framework/views/*.php",
      "./resources/views/**/*.blade.php",
      "./resources/js/**/*.vue",
    ],
  },
  theme: {
    container: {
      center: true,
    },
    extend: {
      fontFamily: {
        sans: ["Nunito", ...defaultTheme.fontFamily.sans],
      },
      screens: {
        xs: "375px",
        ...defaultTheme.screens,
      },
    },
  },

  variants: {
    extend: {
      opacity: ["disabled"],
    },
  },

  plugins: [
    require("@tailwindcss/forms")({
      strategy: "class",
    }),
    require("@tailwindcss/typography"),
  ],
};
