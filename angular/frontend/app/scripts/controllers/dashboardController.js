'use strict'
angular.module('sbAdminApp')
  .controller('DashboardCtrl', function(UserService, IdeaService, $state) {

    var self = this;

    UserService.me().then(function(response) {
      self.me = response.data;
    });

    this.logout = function() {
      localStorage.removeItem('token');
      $state.go('login');
    }

    //this.ideas = [{title: "Title 1"},{title: "Title 1"},{title: "Title 1"}]

    IdeaService.getIdeas().then(function(response) {
      self.ideas = response.data;
    });

    this.addIdea = function(title) {
      this.ideas.push({title: title});
    }

    this.deleteIdea = function(idea) {

    }

});
