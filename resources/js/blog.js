import SwaggerUI from "swagger-ui";
import 'swagger-ui/dist/swagger-ui.css';

SwaggerUI({
  dom_id: '#blog-swagger-api',
  url: 'http://127.0.0.1:8000/docs/blog.json',
});