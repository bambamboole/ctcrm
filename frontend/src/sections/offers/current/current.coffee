currentOffersModule = angular.module "ctcrm.sections.currentOffers", []


currentOffersModule.config  ($stateProvider) ->
  $stateProvider.state "main.currentOffers",
    url: "angebote/aktuell"
    controller: "CurrentOffersCtrl"
    templateUrl: "sections/offers/current/current.tpl.html"

currentOffersModule.controller 'CurrentOffersCtrl', ($scope) ->
  $scope.test = 'ciao'
  @