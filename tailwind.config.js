/** @type {import('tailwindcss').Config} */
module.exports = {
    content: ["./templates/**/*.{html,js,php}"],
    safelist: [
      'w-[32px]', 'h-[32px]',
      'w-[36px]', 'h-[36px]',
      'w-[40px]', 'h-[40px]',
      'w-[48px]', 'h-[48px]',
      'w-[64px]', 'h-[64px]',
      'w-64', 'w-72', 'w-80',
      'pl-72', 'lg:pl-32', 'lg:pr-32', 'pr-16',
      'text-[64px]',
      'list-disc',
      {
         pattern: /bg-(zinc|red|orange|yellow|green|blue|purple|pink)-(700)/
      },
    ],
    theme: {
      extend: {},
    },
    plugins: [
      require('@tailwindcss/forms'),
      // ...
    ],
  }