callsModule = angular.module "ctcrm.sections.calls", []


callsModule.config  ($stateProvider) ->
  $stateProvider.state "main.calls",
    url: "anrufverwaltung/anrufe"
    controller: "CallsCtrl"
    templateUrl: "sections/callmanagement/calls/calls.tpl.html"
    resolve:
      calls: (restApi) ->
        restApi.calls.getFiltered(status: [0, 1]).then (response) ->
          response.data

callsModule.controller 'CallsCtrl', ($scope, $http, $interval, calls, $modal, restApi) ->
  $scope.calls = calls

  emptyCall =
    id: null,
    timestamp: null,
    duration: null,
    number: null,
    note: null,
    state: 0,
    contact: {
      id: null,
      companyName: null,
      firstName: null,
      lastName: null,
      email: null,
      note: null
    }

  $scope.updateCall = (call) ->
    restApi.calls.save call

  $scope.editCall = (call) ->
    openCallModal call

  openCallModal = (call) ->
    $modal.open
      templateUrl: 'sections/callmanagement/calls/callDetailsModal.tpl.html'
      backdrop: true
      windowClass: 'modal'
      controller: 'CallDetailsCtrl'
      resolve:
        call: ->
          call

  checkForNewCallsInterval = $interval ->
    lastCallTimestamp = $scope.calls[0].timestamp
    restApi.calls.getFiltered(timestamp: lastCallTimestamp).then (response) ->
      $scope.calls = response.data.concat $scope.calls
  , 3000

  $scope.$on "$destroy", ->
    $interval.cancel checkForNewCallsInterval

callDetailsModule = angular.module('ctcrm.sections.callDetails', [])

callDetailsModule.controller 'CallDetailsCtrl', ($scope, $modalInstance, call, restApi) ->
  $scope.optionalIsCollapsed = true
  $scope.call = call

  updateCall = ->
      restApi.calls.save(call)

  $scope.submit = ->
    updateCall call
    $modalInstance.close 'save'

  $scope.cancel = ->
    $modalInstance.dismiss()