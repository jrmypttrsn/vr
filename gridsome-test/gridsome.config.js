// This is where project configuration and installed plugin options are located.
// Learn more: https://gridsome.org/docs/config

module.exports = {
  chainWebpack: config => {
    config.module
        .rule('pug')
  },
  plugins: []
}
