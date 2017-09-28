import Ember from 'ember';
import { PerfectScrollbarMixin } from 'ember-perfect-scrollbar';

export default Ember.Component.extend(PerfectScrollbarMixin, {
  perfectScrollbarOptions: {
    suppressScrollX: true
  },
});
