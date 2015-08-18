newOfferModule = angular.module "ctcrm.sections.newOffer", []


newOfferModule.config  ($stateProvider) ->
  $stateProvider.state "main.newOffer",
    url: "angebote/neu"
    controller: "NewOfferCtrl"
    templateUrl: "sections/offers/new/new.tpl.html"

newOfferModule.controller 'NewOfferCtrl', ($scope) ->
  $scope.test = 'ciao'
  @