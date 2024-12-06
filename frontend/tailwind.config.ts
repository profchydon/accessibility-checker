import type { Config } from "tailwindcss";
import theme from "./theme";

const config = {
  darkMode: ["class"],
  important: true,
  content: [
    "./src/pages/**/*.{js,ts,jsx,tsx,mdx}",
    "./src/components/**/*.{js,ts,jsx,tsx,mdx}",
    "./src/container/**/*.{js,ts,jsx,tsx,mdx}",
    "./src/app/**/*.{js,ts,jsx,tsx,mdx}",
  ],
  prefix: "",
  theme: {
    extend: {
      screens: {
        "lg-1": "1281px",
      },
      height: {
        "custom-100": "calc(100vh - 2rem)",
        "custom-200": "calc(100vh - 9.625rem)",
      },
      fontFamily: {
        ibmPlexSans: ["IBM Plex Sans", "sans-serif"],
      },
      boxShadow: {
        lg: "0px 4px 6px -2px rgba(16, 24, 40, 0.03), 0px 12px 16px -4px rgba(16, 24, 40, 0.08)",
        xlg: "0px 8px 8px -4px rgba(16, 24, 40, 0.03), 0px 20px 24px -4px rgba(16, 24, 40, 0.08)",
        xs: "0px 0px 0px 4px #E6EFFF, 0px 1px 2px 0px rgba(16, 24, 40, 0.05)",
        xslg: "0px 1px 2px 0px rgba(16, 24, 40, 0.06), 0px 1px 3px 0px rgba(16, 24, 40, 0.10)",
      },
      backgroundColor: {
        customGray: "rgba(52, 64, 84, 0.15)",
      },
      backgroundImage: {
        customGrayXL:
          "linear-gradient(180deg, rgba(0, 0, 0, 0.00) 0%, rgba(0, 0, 0, 0.20) 100%)",
        customDarkGray:
          "linear-gradient(180deg, rgba(16, 24, 40, 1) 100%, rgba(71, 84, 103, 1) 100%)",
        customGrayXL2:
          "linear-gradient(180deg, rgba(242, 247, 255, 0.00) -1.02%, #F2F7FF 29.75%)",
        backgroundImage_signup:
          "url('/src/assets/images/background_login.png')",
      },
      fontSize: {
        regular: "1.125rem", // 18px
        small: "1rem", // 16px
      },
      keyframes: {
        "accordion-down": {
          from: { height: "0" },
          to: { height: "var(--radix-accordion-content-height)" },
        },
        "accordion-up": {
          from: { height: "var(--radix-accordion-content-height)" },
          to: { height: "0" },
        },
      },
      animation: {
        "accordion-down": "accordion-down 0.2s ease-out",
        "accordion-up": "accordion-up 0.2s ease-out",
      },
    },
    colors: {
      ...theme.colors,
    },
  },
  // eslint-disable-next-line @typescript-eslint/no-require-imports
  plugins: [require("tailwindcss-animate")],
} satisfies Config;

export default config;
