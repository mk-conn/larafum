// file: app/serializers/user.js
import DS from 'ember-data';
import keepOnlyChanged from 'ember-data-change-tracker/mixins/keep-only-changed';

export default DS.JSONAPISerializer.extend(keepOnlyChanged);
