usersModule = angular.module "ctcrm.sections.users", []

usersModule.config ($stateProvider) ->
  $stateProvider.state "main.users",
    url: "verwaltung/benutzer"
    controller: "UsersCtrl"
    templateUrl: "sections/administration/users/users.tpl.html"
    resolve:
      userGroups:(restApi) ->
        restApi.userGroups.getAll().then (response) ->
          response.data
      users:(restApi) ->
        restApi.users.getAll().then (response) ->
          response.data

usersModule.controller 'UsersCtrl', ($scope, $http, $filter, userGroups, users, restApi) ->

  emptyUser =
    id: -1,
    groupId: 1,
    tempName: "Neuer Benutzer",
    firstName: null,
    lastName: null,
    email: null,
    dialMethod: null,
    msn: null

  $scope.userGroups = userGroups
  $scope.users = users

  $scope.selectedGroupId = null
  $scope.setGroup = (groupId) ->
    $scope.selectedGroupId = groupId

  $scope.getGroupName = (id) ->
    $filter('getById')(userGroups, id).name

  $scope.clearFilter = () ->
    $scope.selectedGroupId = null
    $scope.searchText = null

  $scope.selectUser = (user) ->
    angular.forEach $scope.users, (user) ->
      user.selected = false
    $scope.selectedUser = user

  $scope.newUser = () ->
    newUser = angular.copy(emptyUser)
    $scope.users.push newUser
    newUser.editing = true
    $scope.selectUser(newUser)

  $scope.cancelEdit = (user) ->
      user.editing = false

  $scope.deleteUser = (userId) ->
    restApi.users.delete(userId)
    .success () ->
      userIndex = $filter('getIndexById')($scope.users, userId)
      $scope.users.splice userIndex, 1
      $scope.selectedUser = null

  $scope.setNumberType = (index, typeItem) ->
    console.log arguments

  $scope.getNumberType = (typeId) ->
    $filter('getById')($scope.numberTypes, typeId)


  $scope.deleteNumber = (numberIndex) ->
    $scope.selectedUser.numbers.splice numberIndex, 1

  $scope.addNumber = ->
    $scope.selectedUser.numbers.push
      type: null
      number: null

  $scope.editUser = ->
    $scope.selectedUser.editing = true

  $scope.saveUser = (user) ->
    user.editing = false
    restApi.users.save(user)
    .success (response) ->
      console.log response
    .error (errorMsg) ->
      console.log errorMsg

  $scope.updateUserGroup = (userGroup) ->
    console.log userGroup
    restApi.userGroups.save(userGroup)
    .success (response) ->
      console.log response
    .error (errorMsg) ->
      console.log errorMsg
