import Ember from 'ember';
import config from './config/environment';

const Router = Ember.Router.extend({
  location: config.locationType,
  rootURL: config.rootURL
});

Router.map(function () {
  this.route('login');
  this.route('settings');

  this.route('feeds', {path: '/feeds'}, function () {
    this.route('feed', {path: '/:feed_id'}, function () {
      this.route('articles', function () {
        this.route('article', {path: '/:article_id'});
      });
      this.route('settings');
    });
  });
});

export default Router;