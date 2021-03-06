import DS from 'ember-data';

const {Model, attr, belongsTo} = DS;

export default Model.extend({
  title: attr('string'),
  content: attr('string'),
  scraped: attr('string'),
  description: attr('string'),
  categories: attr(),
  author: attr('string'),
  language: attr('string'),
  publishDate: attr('date'),
  updatedDate: attr('date'),
  feed: belongsTo('feed'),
  url: attr('string'),
  read: attr('boolean'),
  keep: attr('boolean')
});
