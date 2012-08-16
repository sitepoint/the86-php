#!/usr/bin/env ruby

require "pathname"
DIR = Pathname(__FILE__).realpath.join("../../testlib")

repositories = []

%w{
  phpunit
  dbunit
  php-file-iterator
  php-text-template
  php-code-coverage
  php-token-stream
  php-timer
  phpunit-mock-objects
  phpunit-selenium
  phpunit-story
  php-invoker
}.each do |r|
  repositories << [
    "git://github.com/sebastianbergmann/#{r}.git",
    "#{DIR}/#{r}"
  ]
end

%w{
  Yaml
  Finder
}.each do |r|
  repositories << [
    "git://github.com/symfony/#{r}.git",
    "#{DIR}/symfony/Symfony/Component/#{r}"
  ]
end

puts "Cloning #{repositories.length} repositories in parallel:"
repositories.each { |(url, dir)| puts "  #{url}  =>  #{dir}" }

pids = repositories.map do |(url, dir)|
  Process.spawn("git clone --quiet #{url} #{dir}")
end

%w{INT TERM}.each do |signal|
  trap(signal) do
    puts "PID #{Process.pid} passing first SIG#{signal} to #{pids.join(", ")}"
    pids.each { |pid| Process.kill(signal, pid) }
    trap(signal) do
      puts "PID #{Process.pid} exiting on second SIG#{signal}"
      exit(1)
    end
  end
end

pids.length.times do |p|
  Process.wait
  print "."
end

puts " done."
