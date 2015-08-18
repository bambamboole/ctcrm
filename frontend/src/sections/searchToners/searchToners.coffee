searchTonersModule = angular.module "ctcrm.sections.searchToners", []


searchTonersModule.config  ($stateProvider) ->
  $stateProvider.state "main.searchToners",
    url: "toner/suche"
    controller: "SearchTonersCtrl"
    templateUrl: "sections/searchToners/searchToners.tpl.html"
    resolve:
      toners:($http) ->
        $http.get('./assets/data/toners.json').then (response) ->
          response.data

searchTonersModule.controller 'SearchTonersCtrl', ($scope, $http, toners, ngTableParams) ->

  $scope.toners = toners

  $scope.tableParams = new ngTableParams
      page: 1
      count: 25
    ,
    total: $scope.toners.length
    getData: ($defer, params) ->
      $defer.resolve $scope.toners.slice((params.page() - 1) * params.count(), params.page() * params.count())
