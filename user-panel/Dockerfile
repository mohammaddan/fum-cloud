FROM node:latest

RUN npm install -g @quasar/cli

WORKDIR /app
COPY . /app
RUN npm install
RUN quasar build
CMD quasar serve dist/spa
EXPOSE 4000
