let url = 'http://localhost:8080/wp-json/shopz/graphql';

// If we're running on Docker, use the WordPress container hostname instead of localhost.
if (process.env.HOME === '/home/node') {
  // graphql
  url = 'http://wp-headless:8080/graphql';
}
const Config = {
  gqlUrl: url,
};

export default Config;
