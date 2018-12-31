// This is where project configuration and installed plugin options are located.
// Learn more: https://gridsome.org/docs/config

module.exports = {
  plugins: [
    {
      use: '~/src/sources/products',
      options: {
        apiKey: 'keySZqJZOExXdpFDN',
        base: 'Furniture',
      },
    }
  ],
};
