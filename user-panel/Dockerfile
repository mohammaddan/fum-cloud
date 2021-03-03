FROM node:latest

RUN npm install -g @quasar/cli

WORKDIR /app
COPY . /app
RUN npm install
RUN quasar build && cp ./_redirects dist/spa
CMD quasar serve dist/spa
#CMD quasar dev
EXPOSE 4000
#EXPOSE 8080
