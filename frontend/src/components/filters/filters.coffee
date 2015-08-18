filtersModule = angular.module "ctcrm.components.filters", []

filtersModule.filter 'getById', ->
  (items, id) ->
    for item in items
      return item if item.id == id
    false

filtersModule.filter 'getIndexById', ->
  (items, id) ->
    for item, index in items
      return index if item.id == id
    false


filtersModule.filter 'isInGroup', ->
  (items, id) ->
    return items if !id
    items.filter (item) ->
      +item.groupId == +id


filtersModule.filter 'formatMoment', ->
  (timestamp, format) ->
    moment(timestamp).format format

