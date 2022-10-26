FROM ubuntu:latest
RUN touch test
RUN echo 'hello world' > test

#使うDockerイメージ  
FROM mysql:5.7

#日本語設定  
RUN apt-get update && apt-get install -y locales  
RUN sed -i -E 's/# (ja\_JP.UTF-8)/\\1/' /etc/locale.gen && locale-gen  
ENV LANG ja\_JP.UTF-8
