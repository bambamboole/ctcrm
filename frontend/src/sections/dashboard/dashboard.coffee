angular.module "ctcrm.sections.dashboard", []


.config ($stateProvider) ->
  $stateProvider.state "main.dashboard",
    url: "dashboard"
    controller: "DashboardCtrl"
    templateUrl: "sections/dashboard/dashboard.tpl.html"
    resolve:
      calls: (restApi) ->
        restApi.calls.getAll().then (response) ->
          response.data
      tasks:(restApi) ->
        restApi.tasks.getAll().then (response) ->
          response.data
      favorites:(restApi) ->
        restApi.favorites.getAll().then (response) ->
          response.data

.controller 'DashboardCtrl', ($scope, $modal, $filter, calls, tasks, favorites, restApi) ->

  $scope.favorites = favorites
  $scope.calls = calls
  $scope.tasks = tasks

  $scope.updateTaskState = (task) ->
    restApi.tasks.save(task)

  $scope.updateTask = (task) ->
    restApi.tasks.save(task)


  $scope.updateCallState = (call) ->
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


angular.module('ctcrm.sections.callDetails', [])

.controller 'CallDetailsCtrl', ($scope, $modalInstance, call, restApi) ->
  $scope.optionalIsCollapsed = true
  $scope.call = call

  updateCall = ->
    restApi.calls.save(call)

  $scope.submit = ->
    updateCall call
    $modalInstance.close 'save'

  $scope.cancel = ->
    $modalInstance.dismiss()

