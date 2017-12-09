import Ember from 'ember';
import { computed, get } from '@ember/object';
import AuthenticatedRouteMixin from 'ember-simple-auth/mixins/authenticated-route-mixin';

const {Route, RSVP} = Ember;

function sortedItems(collection, collectionKey, property) {
  return computed(`${collectionKey}.@each.${property}`, {
    get() {
      return collection.sortBy(property);
    }
  })
}

export default Route.extend(AuthenticatedRouteMixin, {

  model() {
    this.debug(`route: %s::model()`, this.routeName);
    return RSVP.hash({
      feeds: this.get('store').query(
        'feed', {
          sort: 'order'
        }
      ),
      folders: this.get('store')
        .query('folder', {
          sort: 'order',
          include: 'feeds'
        })
    });
  },

  renderTemplate() {
    this.render('feeds', {
      into: 'application',
      outlet: 'side-bar'
    })
  },


  setupController(controller, model) {

    controller.set('folders', model.folders);
    controller.set('feeds', model.feeds);

  },


  actions: {
    /**
     *
     * @param folder
     */
    openFolder(folder) {
      this.debug(`route: %s::openFolder(%s)`, this.routeName, get(folder, 'name'));
      folder.set('open', true);
      folder.save();
    },
    /**
     *
     * @param folder
     */
    closeFolder(folder) {
      folder.set('open', false);
      folder.save();
    },
    /**
     *
     * @param folder
     * @param feed
     */
    addFeedToFolder(folder, feed) {

      feed.set('folder', folder);
      feed.save().then(() => {
        this.refresh();
      });


    },
    /**
     *
     * @param sortables
     */
    sort(sortables) {
      this.debug(`route: %s::sort()`, this.routeName);
      let changed = [];
      sortables.forEach((model, idx) => {
        this.debug(`\t->id: %s idx: %s`, get(model, 'id'), idx + 1);
        let newIdx = idx + 1;
        const currentIdx = model.get('order');

        if (currentIdx !== newIdx) {
          this.debug(`\tsetting order for %s to %s`, model.get('id'), model.get('order'));
          model.set('order', newIdx);
          changed.push(model);
        }
      });

      changed.invoke('save');
    }
  }

});
