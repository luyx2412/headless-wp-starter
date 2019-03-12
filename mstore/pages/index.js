import React from 'react';
import { bindActionCreators } from 'redux';
import withRedux from 'next-redux-wrapper';
import gql from 'graphql-tag';

import {
  initStore,
  startClock,
  addCount,
  serverRenderClock,
} from '../lib/store';
import App from '../components/App';
import Header from '../components/Header';
import Page from '../components/Page';
import Submit from '../components/Submit';
import withApollo from '../lib/withApollo';

/**
 * GraphQL pages and categories query
 * Gets all available pages and posts titles and slugs
 */
const PRODUCTS_QUERY = gql`
  query ProductsQuery {
    products {
      name
      image
    }
  }
`;

class Index extends React.Component {
  static getInitialProps({ store, isServer }) {
    store.dispatch(serverRenderClock(isServer));
    store.dispatch(addCount());

    return { isServer };
  }

  state = { products: null };

  componentDidMount() {
    this.timer = this.props.startClock();
    this.executePagesAndCategoriesQuery();
  }

  componentWillUnmount() {
    clearInterval(this.timer);
  }

  /**
   * Execute the pages and categories query and set the state
   */
  executePagesAndCategoriesQuery = async () => {
    const { client } = this.props;
    const result = await client.query({
      query: PRODUCTS_QUERY,
    });

    const { products } = result.data;

    this.setState({ products });
  };

  render() {
    const { products } = this.state;

    return (
      <App>
        <Header />
        <Page title="Index" />
        <Submit />
        {/* <PostList /> */}
        {products &&
          products.map((o, i) => {
            return (
              <div key={i.toString()}>
                {o.name}
                <img src={o.image} />
              </div>
            );
          })}
      </App>
    );
  }
}

const mapDispatchToProps = dispatch => {
  return {
    addCount: bindActionCreators(addCount, dispatch),
    startClock: bindActionCreators(startClock, dispatch),
  };
};

export default withApollo(
  withRedux(initStore, null, mapDispatchToProps)(Index),
);
