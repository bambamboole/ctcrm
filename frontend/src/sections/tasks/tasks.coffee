tasksModule = angular.module "ctcrm.sections.tasks", []


tasksModule.config ($stateProvider) ->
  $stateProvider.state "main.tasks",
    url: "aufgaben"
    controller: "TaskCtrl"
    templateUrl: "sections/tasks/tasks.tpl.html"
    resolve:
      tasks:(restApi) ->
        restApi.tasks.getAll().then (response) ->
          response.data

tasksModule.controller 'TaskCtrl', ($scope, $filter, tasks, restApi) ->

  $scope.tasks = tasks

  $scope.updateTaskState = (task) ->
    restApi.tasks.save(task)

  $scope.updateTask = (task) ->
    restApi.tasks.save(task)