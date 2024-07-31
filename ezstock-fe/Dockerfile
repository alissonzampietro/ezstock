FROM node:18

WORKDIR /app

COPY ./ezstock-fe/package.json .

RUN ls -la

RUN npm install
COPY ./ezstock-fe .
RUN rm -rf dist/
RUN npm run build

RUN npm install -g serve

CMD ["serve", "-s", "dist", "-p", "5000"]

EXPOSE 5000
