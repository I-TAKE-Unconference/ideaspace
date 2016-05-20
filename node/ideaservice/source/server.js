var hapi = require('hapi');
var Boom = require('boom');
var mongoose = require('mongoose');

mongoose.connect('mongodb://localhost/ideaService');

var IdeaModel = mongoose.model('myModel', new mongoose.Schema({
  member_id: String,
  ideaspace_id: String,
  title: String,
  description: String
}));

module.exports.create = function() {

  var server = new hapi.Server();
  server.connection({
      host: 'localhost',
      port: 8000
  });

  server.route({
    method: 'GET',
    path:'/',
    handler: function (request, reply) {
      var query = {};

      if(request.query.member_id) {
        query.member_id = request.query.member_id;
      }

      if(request.query.exclude_member_id) {
        query.member_id = {
          $ne: request.query.exclude_member_id
        };
      }

      console.log(query);

      IdeaModel.find(query).exec(function(err, data) {
        if (err) {
          return reply(Boom.badRequest('db error'));
        }

        return reply(JSON.stringify(data));
      });
    }
  });

  server.route({
    method: 'POST',
    path:'/',
    handler: function (request, reply) {
      var idea = new IdeaModel(request.payload);

      idea.save(function (err, data) {
        if (err) {
          return reply(Boom.badRequest('db error'));
        }

        return reply(JSON.stringify(data));
      });
    }
  });

  server.route({
    method: 'DELETE',
    path:'/{id}',
    handler: function (request, reply) {
      var idea = new IdeaModel(request.payload);

      console.log(request.params.id);

      IdeaModel.remove({ _id: request.params.id }, function (err) {
        if (err) {
          return reply(Boom.badRequest('db error'));
        }

        return reply();
      });
    }
  });

  return server;
};
