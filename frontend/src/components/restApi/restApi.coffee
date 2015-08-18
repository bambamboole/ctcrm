angular.module "ctcrm.components.restApi", []

.provider 'restApi', ->
  apis =
    calls:          'backend/calls'
    contacts:       './assets/data/contacts.json'
    contactGroups:  './assets/data/contactGroups.json'
    contactTitles:  './assets/data/contactTitles.json'
    numberTypes:    './assets/data/numberTypes.json'
    tasks:          './assets/data/tasks.json'
    articleGroups:  './assets/data/articleGroups.json'
    articles:       './assets/data/articles.json'
    userGroups:     './assets/data/userGroups.json'
    users:          './assets/data/users.json'
    favorites:      './assets/data/favorites.json'


  $get: (RestApiFactory) ->
    restApis = {}
    for apiName, apiURL of apis
      restApis[apiName] = new RestApiFactory apiURL
    restApis

.factory 'RestApiFactory', ($http) ->
  class RestApi
    constructor: (@BASE_URL) ->

    get: (id) ->
      $http.get "#{ @BASE_URL }/#{ id }"

    getAll: ->
      $http.get @BASE_URL

    getFiltered: (filter) ->
      $http.get @BASE_URL, params: filter: filter

    save: (item) ->

      if item.id == -1
        $http
          url: @BASE_URL,
          method: "POST",
          data: item,
          headers: {'Content-Type': 'application/json'}

      else
        $http
          url: @BASE_URL,
          method: "PUT",
          data: item,
          headers: {'Content-Type': 'application/json'}

    delete: (id) ->
      $http.delete "#{ @BASE_URL }/#{ id }"

