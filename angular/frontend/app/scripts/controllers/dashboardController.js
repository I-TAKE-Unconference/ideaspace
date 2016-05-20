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
    };

    //this.ideas = [{title: "Title 1"},{title: "Title 1"},{title: "Title 1"}]

    IdeaService.getIdeas().then(function(response) {
      self.ideas = response.data;
    });

    this.addIdea = function(title) {
      var idea = {
        title: title,
        member_id: this.me.id
      };

      IdeaService.addIdea(idea).then(function(response) {
        if(response.status == 200) {
          self.ideas.push(response.data);
        } else {
          alert("Error on sending data");
        }
      });
    };

    this.deleteIdea = function(idea) {

    };

});
