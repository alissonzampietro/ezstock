FROM node:latest
WORKDIR /server
COPY . /server/
EXPOSE 3000
RUN npm i -g json-server -y
ENTRYPOINT ["npx", "json-server", "collection.json"]