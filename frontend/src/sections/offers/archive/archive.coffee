offersArchiveModule = angular.module "ctcrm.sections.offersArchive", []


offersArchiveModule.config  ($stateProvider) ->
  $stateProvider.state "main.offersArchive",
    url: "angebote/Archiv"
    controller: "OffersArchiveCtrl"
    templateUrl: "sections/offers/archive/archive.tpl.html"

offersArchiveModule.controller 'OffersArchiveCtrl', ($scope) ->
  $scope.test = 'ciao'
  @