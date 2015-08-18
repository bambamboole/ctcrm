callsArchiveModule = angular.module "ctcrm.sections.callsArchive", []


callsArchiveModule.config  ($stateProvider) ->
  $stateProvider.state "main.callsArchive",
    url: "anrufverwaltung/archiv"
    controller: "CallsArchiveCtrl"
    templateUrl: "sections/callmanagement/archive/archive.tpl.html"
    resolve:
      calls: (restApi) ->
        restApi.calls.getAll().then (response) ->
          response.data
      contacts: (restApi) ->
        restApi.contacts.getAll().then (response) ->
          response.data

callsArchiveModule.controller 'CallsArchiveCtrl', ($scope, contacts, calls) ->

  $scope.contact ={}
  $scope.contacts = contacts
  $scope.calls = calls

  $scope.disabled = undefined;

  $scope.enable = ->
    $scope.disabled = false

  $scope.disable = ->
    $scope.disabled = true

  $scope.clear = ->
    $scope.contact.selected = undefined
