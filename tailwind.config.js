/** @type {import('tailwindcss').Config} */
module.exports = {
    content: ["./templates/**/*.{html,js,php}"],
    safelist: [
      'w-[32px]', 'min-w-[32px]', 'h-[32px]', 'min-h-[32px]',
      'w-[36px]', 'min-w-[36px]', 'h-[36px]', 'min-h-[36px]',
      'w-[40px]', 'min-w-[40px]', 'h-[40px]', 'min-h-[40px]',
      'w-[48px]', 'min-w-[48px]', 'h-[48px]', 'min-h-[48px]',
      'w-[64px]', 'min-w-[64px]', 'h-[64px]', 'min-h-[64px]',
      'w-64', 'w-72', 'w-80',
      'pl-72', 'lg:pl-32', 'lg:pr-32', 'pr-16',
      'left-0', 'lg:left-64', 'xl:left-72',
      'right-0', 'lg:right-48', 'xl:right-64',
      'text-[64px]',
      'list-disc',
      {
         pattern: /bg-(zinc|red|orange|yellow|green|blue|purple|pink)-(700)/
      },
      {
        pattern: /from-(zinc|red|orange|yellow|green|blue|purple|pink)-(700)/
      },
      {
        pattern: /to-(zinc|red|orange|yellow|green|blue|purple|pink)-(800)/
      },
    ],
    theme: {
      extend: {},
    },
    plugins: [
      //require('@tailwindcss/forms'),
      // ...
    ],
  }