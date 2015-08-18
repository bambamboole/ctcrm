ctcrmModule = angular.module("ctcrm", [
  "ngAnimate"
  "ngSanitize"
  "ui.router"
  "ui.select"
  "ui.bootstrap"
  "ngTable"

  "ctcrm.login"
  "ctcrm.templates"
  "ctcrm.navigation"
  "ctcrm.sections"
  "ctcrm.components"
])

ctcrmModule.run ($rootScope, auth) ->
  moment.locale "de"

  $rootScope.$on '$stateChangeStart', ->
    console.log 'StateChange', arguments

  $rootScope.isAllowed = (accessLevel) ->
    auth.isAllowed accessLevel

ctcrmModule.config ($stateProvider, $urlRouterProvider) ->
  $stateProvider.state "main",
    url: "/"
    controller: 'MainCtrl'
    templateUrl: "index.tpl.html"
    onEnter: ($state, auth) ->
      $state.go 'login' unless auth.isLoggedIn


  $urlRouterProvider.otherwise "/dashboard"

ctcrmModule.controller 'MainCtrl', ($scope, auth) ->
  $scope.auth = auth
  console.log $scope.auth