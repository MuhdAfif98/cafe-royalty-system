/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./app/Livewire/**/*.php",
  ],
  theme: {
    extend: {
      colors: {
        primary: {
          DEFAULT: '#6F4E37', // Mocha Brown
          50:  '#F5F3F0',  // Coffee foam
          100: '#EDE6E0',
          200: '#DACFC5',
          300: '#BFA89A',
          400: '#A68278',
          500: '#8B5C55',
          600: '#6F4E37',
          700: '#553B2C',
          800: '#3C2921',
          900: '#241813',
        },
        secondary: {
          DEFAULT: '#CBB38A', // Latte Beige
          50:  '#FAF7F3',
          100: '#F3ECE3',
          200: '#E7DAC5',
          300: '#D9C4A6',
          400: '#CBB38A',
          500: '#B89A66',
          600: '#9E7C4F',
          700: '#7D5F3C',
          800: '#5B442A',
          900: '#3C2C1C',
        },
        accent: {
          DEFAULT: '#A9745B', // Caramel
          50:  '#FBF6F4',
          100: '#F4E9E3',
          200: '#E9D1C1',
          300: '#DDAF9C',
          400: '#C98978',
          500: '#A9745B',
          600: '#865942',
          700: '#643E2E',
          800: '#42261B',
          900: '#24130D',
        },
        tertiary: {
          DEFAULT: '#8A9A5B', // Matcha Green (fresh accent)
          50:  '#F8FAF5',
          100: '#EEF4E6',
          200: '#DAE3C2',
          300: '#C2CF9E',
          400: '#AAB878',
          500: '#8A9A5B',
          600: '#6E7A46',
          700: '#525C34',
          800: '#383F23',
          900: '#1E2213',
        },
        neutral: {
          DEFAULT: '#2E2E2E', // Dark charcoal
          50:  '#FAFAFA',
          100: '#F4F4F4',
          200: '#E5E5E5',
          300: '#D4D4D4',
          400: '#A3A3A3',
          500: '#737373',
          600: '#525252',
          700: '#404040',
          800: '#2E2E2E',
          900: '#171717',
        },
      },
    },
  },
  plugins: [],
}
