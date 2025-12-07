module.exports = {
  plugins: {
    'tailwindcss': {},
    'autoprefixer': {},
    'postcss-import': {},
    'postcss-nested': {},
    'cssnano': process.env.NODE_ENV === 'production' ? {} : false,
  }
}