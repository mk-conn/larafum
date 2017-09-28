import Ember from 'ember';

const {Route, inject} = Ember;

export default Route.extend({

  gui: inject.service(),

  model(params) {
    return this.get('store').findRecord('article', params.article_id);
  },

  renderTemplate() {
    this.render('feeds/feed/articles/article', {
      into: 'application',
      outlet: 'column-two'
    })
  },

  actions: {
    originalArticle() {

    },
  }
});
