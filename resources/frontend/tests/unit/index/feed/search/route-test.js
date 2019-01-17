import { module, test } from 'qunit';
import { setupTest } from 'ember-qunit';

module('Unit | Route | index/feed/search', function(hooks) {
  setupTest(hooks);

  test('it exists', function(assert) {
    let route = this.owner.lookup('route:index/feed/search');
    assert.ok(route);
  });
});
