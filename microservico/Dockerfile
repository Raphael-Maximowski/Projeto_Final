FROM node:current-alpine 

RUN mkdir -p /microservico

WORKDIR /microservico

COPY package*.json ./
 
RUN npm install

EXPOSE 3005
 
CMD [ "npm", "run", "dev" ]