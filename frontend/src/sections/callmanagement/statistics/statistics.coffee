callsStatisticsModule = angular.module "ctcrm.sections.callsStatistics", []


callsStatisticsModule.config  ($stateProvider) ->
  $stateProvider.state "main.callsStatistics",
    url: "anrufverwaltung/statistik"
    controller: "CallsStatisticsCtrl"
    templateUrl: "sections/callmanagement/statistics/statistics.tpl.html"

callsStatisticsModule.controller 'CallsStatisticsCtrl', ($scope) ->
  $scope.test = 'ciao'
  @